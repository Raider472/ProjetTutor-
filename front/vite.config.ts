import { sveltekit } from '@sveltejs/kit/vite';
import { loadEnv } from 'vite';
import { defineConfig } from 'vitest/config';

export default defineConfig(({mode})=> {
	process.env = {...process.env, ...loadEnv(mode, process.cwd())}
	console.log(process.env.VITE_USE_POLLING, process.env.VITE_POLLING_INTERVAL)

	return {
		plugins: [sveltekit()],
		server: {
			watch: {
				usePolling: process.env.VITE_USE_POLLING === "true",
				interval: parseInt(process.env.VITE_POLLING_INTERVAL ?? "1000", 10) 
			},
		},
		test: {
			include: ['src/**/*.{test,spec}.{js,ts}']
		}
	}
});
