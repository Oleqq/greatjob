const { exec } = require("child_process");

function openBrowser(url) {
	if (process.platform === "win32") {
		exec(`start "" "${url}"`);
		return;
	}

	const command = process.platform === "darwin" ? "open" : "xdg-open";
	exec(`${command} "${url}"`);
}

module.exports = { openBrowser };
