#!/usr/bin/env node

const fs = require("fs");
const path = require("path");
const pug = require("pug");

const root = path.resolve(__dirname, "..");
const pagesDir = path.join(root, "static", "template-parts", "pug", "pages");
const outputDir = path.join(root, "static");
const watchMode = process.argv.includes("--watch");

function getPages() {
	return fs.readdirSync(pagesDir, { withFileTypes: true })
		.filter((entry) => entry.isFile() && entry.name.endsWith(".pug"))
		.map((entry) => entry.name);
}

function build() {
	getPages().forEach((fileName) => {
		const source = path.join(pagesDir, fileName);
		const target = path.join(outputDir, fileName.replace(/\.pug$/, ".html"));
		const html = pug.renderFile(source, {
			pretty: true,
			basedir: path.join(root, "static", "template-parts", "pug")
		});
		fs.writeFileSync(target, html);
		console.log(`rendered ${path.relative(root, target)}`);
	});
}

build();

if (watchMode) {
	let timer;
	fs.watch(path.join(root, "static", "template-parts", "pug"), { recursive: true }, () => {
		clearTimeout(timer);
		timer = setTimeout(() => {
			try { build(); } catch (error) { console.error(error.message); }
		}, 100);
	});
	console.log("watching static/template-parts/pug");
}
