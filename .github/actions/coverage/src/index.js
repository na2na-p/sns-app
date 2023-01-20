import { promises as fs } from "fs"
import core from "@actions/core"
import { GitHub, context } from "@actions/github"

import { parse } from "./clover"
import { diff } from "./comment"

async function main() {
	const token = core.getInput("github-token")
	const cloverFile = core.getInput("clover-file") || "./coverage/clover.xml"
	const baseFile = core.getInput("clover-base")

	const raw = await fs.readFile(cloverFile, "utf-8").catch(err => null)
	if (!raw) {
		console.log(`No coverage report found at '${cloverFile}', exiting...`)
		return
	}

	const baseRaw =
		baseFile && (await fs.readFile(baseFile, "utf-8").catch(err => null))
	if (baseFile && !baseRaw) {
		console.log(`No coverage report found at '${baseFile}', ignoring...`)
	}

	const options = {
		repository: context.payload.repository.full_name,
		commit: context.payload.pull_request.head.sha,
		prefix: `${process.env.GITHUB_WORKSPACE}/`,
		head: context.payload.pull_request.head.ref,
		base: context.payload.pull_request.base.ref,
	}

	const clover = await parse(raw)
	const baseclover = baseRaw && (await parse(baseRaw))
	const body = diff(clover, baseclover, options)

	// await new GitHub(token).issues.createComment({
	// 	repo: context.repo.repo,
	// 	owner: context.repo.owner,
	// 	issue_number: context.payload.pull_request.number,
	// 	body: diff(clover, baseclover, options),
	// })
	// 自分のコメントを更新する。なければ作成する。
	// "No coverage report found"から始まるか、"Coverage after"から始まるかで判断する。
	const comments = await new GitHub(token).issues.listComments({
		repo: context.repo.repo,
		owner: context.repo.owner,
		issue_number: context.payload.pull_request.number,
	})
	// 今の自分の名前と同じAuthorのコメントを探す
	const myComment = comments.data.find(
		comment =>
			comment.user.login === context.actor &&
			(comment.body.startsWith("No coverage report found") ||
				comment.body.startsWith("Coverage after"))
	)
	if (myComment) {
		await new GitHub(token).issues.updateComment({
			repo: context.repo.repo,
			owner: context.repo.owner,
			comment_id: myComment.id,
			body,
		})
	} else {
		await new GitHub(token).issues.createComment({
			repo: context.repo.repo,
			owner: context.repo.owner,
			issue_number: context.payload.pull_request.number,
			body,
		})
	}
}

main().catch(function(err) {
	console.log(err)
	core.setFailed(err.message)
})
