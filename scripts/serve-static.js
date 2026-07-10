#!/usr/bin/env node

const fs = require("fs");
const http = require("http");
const path = require("path");
const { openBrowser } = require("./open-browser");

const root = path.join(__dirname, "..", "static");
const port = Number(process.env.PORT || 4173);
const openIndex = process.argv.indexOf("--open");
const openTarget = openIndex >= 0 ? process.argv[openIndex + 1] || "index.html" : "";
const mime = {
	".css": "text/css; charset=utf-8",
	".html": "text/html; charset=utf-8",
	".js": "text/javascript; charset=utf-8",
	".json": "application/json; charset=utf-8",
	".jpg": "image/jpeg",
	".jpeg": "image/jpeg",
	".png": "image/png",
	".svg": "image/svg+xml",
	".webp": "image/webp"
};

function resolvePath(url) {
	const pathname = decodeURIComponent((url || "/").split("?")[0]);
	const normalized = pathname === "/" ? "/index.html" : pathname;
	const target = path.normalize(path.join(root, normalized));
	return target.startsWith(root) ? target : null;
}

const server = http.createServer((request, response) => {
	const filePath = resolvePath(request.url);
	if (!filePath) {
		response.writeHead(403);
		response.end("Forbidden");
		return;
	}

	fs.readFile(filePath, (error, file) => {
		if (error) {
			response.writeHead(404, { "content-type": "text/plain; charset=utf-8" });
			response.end("Not found");
			return;
		}

		response.writeHead(200, { "content-type": mime[path.extname(filePath).toLowerCase()] || "application/octet-stream" });
		response.end(file);
	});
});

server.listen(port, "127.0.0.1", () => {
	console.log(`Static preview: http://127.0.0.1:${port}`);
	if (openIndex >= 0) {
		setTimeout(() => openBrowser(`http://127.0.0.1:${port}/${String(openTarget).replace(/^\/+/, "")}`), 300);
	}
});
