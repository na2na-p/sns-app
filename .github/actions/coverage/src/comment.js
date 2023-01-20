import { details, summary, b, fragment, table, tbody, tr, th } from "./html"

import { percentage } from "./clover"
import { tabulate } from "./tabulate"

export function comment(clover, options) {
	return fragment(
		`Coverage after merging ${b(options.head)} into ${b(options.base)}`,
		table(tbody(tr(th(percentage(clover).toFixed(2), "%")))),
		"\n\n",
		details(summary("Coverage Report"), tabulate(clover, options)),
	)
}

export function diff(clover, before, options) {
	if (!before) {
		return comment(clover, options)
	}

	const pbefore = percentage(before)
	const pafter = percentage(clover)
	const pdiff = pafter - pbefore
	const plus = pdiff > 0 ? "+" : ""
	const arrow = pdiff === 0 ? "" : pdiff < 0 ? "▾" : "▴"

	return fragment(
		`Coverage after merging ${b(options.head)} into ${b(options.base)}`,
		table(
			tbody(
				tr(
					th(pafter.toFixed(2), "%"),
					th(arrow, " ", plus, pdiff.toFixed(2), "%"),
				),
			),
		),
		"\n\n",
		details(summary("Coverage Report"), tabulate(clover, options)),
	)
}
