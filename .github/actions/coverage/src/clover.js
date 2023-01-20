import { parseContent } from "@technote-space/clover-json"

// Parse clover string into clover data
export function parse(data) {
	return parseContent(data)
}

// Get the total coverage percentage from the clover data.
export function percentage(clover) {
	let hit = 0
	let found = 0
	for (const entry of clover) {
		hit += entry.lines.hit
		found += entry.lines.found
	}

	return (hit / found) * 100
}
