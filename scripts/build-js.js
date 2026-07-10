#!/usr/bin/env node

const path = require("path");
const esbuild = require("esbuild");

const root = path.resolve(__dirname, "..");
const options = {
	entryPoints: [path.join(root, "static", "js", "script.js")],
	outfile: path.join(root, "static", "js", "app.js"),
	bundle: true,
	format: "iife",
	target: "es2020",
	logLevel: "info"
};

async function main() {
	if (process.argv.includes("--watch")) {
		const context = await esbuild.context(options);
		await context.watch();
		console.log("watching static/js");
		return;
	}

	await esbuild.build(options);
}

main().catch((error) => {
	console.error(error);
	process.exit(1);
});
