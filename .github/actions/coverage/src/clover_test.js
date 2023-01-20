import { parse, percentage } from "./clover"

test("parse should parse clover strings correctly", async function() {
	const data = `
<?xml version="1.0" encoding="UTF-8"?>
<coverage generated="1320170507">
    <project timestamp="1320170507">
        <package name="hello.world">
            <file name="app/Models/Scenario.php">
            <class name="App\\Models\\Scenario" namespace="App\\Models">
                <metrics complexity="0" methods="0" coveredmethods="0" conditionals="0" coveredconditionals="0" statements="0" coveredstatements="0" elements="0" coveredelements="0"/>
            </class>
            <metrics loc="10" ncloc="10" classes="0" methods="0" coveredmethods="0" conditionals="0" coveredconditionals="0" statements="0" coveredstatements="0" elements="0" coveredelements="0"/>
            </file>
            <metrics files="1" loc="0" ncloc="0" classes="1" methods="0" coveredmethods="0" conditionals="0" coveredconditionals="0" statements="0" coveredstatements="0" elements="0" coveredelements="0"/>
        </package>
    </project>
</coverage>
`

	const clover = await parse(data)
	expect(clover).toEqual([
		{
			file: "hello.world/app/Models/Scenario.php",
			functions: {
				details: [],
				found: 0,
				hit: 0,
			},
			lines: {
				details: [],
				found: 0,
				hit: 0,
			},
			title: "App\\Models\\Scenario",
		},
	])
})

test("parse should fail on invalid clover", async function() {
	await expect(parse("invalid")).rejects.toStrictEqual(
		new Error("Non-whitespace before first tag.\nLine: 0\nColumn: 1\nChar: i"),
	)
})

test("percentage should calculate the correct percentage", function() {
	expect(
		percentage([
			{ lines: { hit: 20, found: 25 } },
			{ lines: { hit: 10, found: 15 } },
		]),
	).toBe(75)
})
