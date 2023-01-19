import { test } from '@playwright/test';

test('タイムラインのルーティングチェック', async ({ page }) => {
	await page.goto('/');

	await page.waitForSelector('text=タイムライン');
});
