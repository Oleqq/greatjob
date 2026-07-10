#!/usr/bin/env node

const { spawn, spawnSync } = require("child_process");

const npm = process.platform === "win32" ? "npm.cmd" : "npm";
const noServe = process.argv.includes("--no-serve");
const openIndex = process.argv.indexOf("--open");
const openTarget = openIndex >= 0 ? process.argv[openIndex + 1] || "index.html" : "";
const tasks = ["watch:pug", "watch:scss", "watch:js"];

if (!noServe) tasks.push("serve");

const build = spawnSync(npm, ["run", "build"], { stdio: "inherit" });
if (build.status !== 0) process.exit(build.status || 1);

const children = tasks.map((task) => spawn(npm, ["run", task], { stdio: "inherit" }));
let closing = false;

function shutdown(code = 0) {
	if (closing) return;
	closing = true;
	children.forEach((child) => child.kill());
	process.exit(code);
}

children.forEach((child, index) => child.on("exit", (code) => {
		if (!closing) {
			console.error(`${tasks[index]} exited with code ${code}`);
			shutdown(code || 1);
		}
	}));

process.on("SIGINT", () => shutdown());
process.on("SIGTERM", () => shutdown());

if (openIndex >= 0 && !noServe) {
	setTimeout(() => require("./open-browser").openBrowser(`http://127.0.0.1:4173/${openTarget}`), 1200);
}
