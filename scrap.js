const puppeteer = require('puppeteer-core');

const username = 'your_email@example.com';
const password = 'your_password';

(async () => {
  const browser = await puppeteer.launch({
    executablePath: 'C:/Program Files/Google/Chrome/Application/chrome.exe', // Replace with your Chrome executable path
  });

  const page = await browser.newPage();

  // Navigate to the login page
  await page.goto('https://yalidine.app/app/login.php');

  // Wait for the email input field to be present
  await page.waitForSelector('input[name="email"]');

  // Type the username (email)
  await page.type('input[name="email"]', username);

  // Type the password
  await page.type('input[name="password"]', password);

  // Click the login button
  await page.click('button[type="submit"]');

  // Wait for navigation after login
  await page.waitForNavigation();

  // Continue with the rest of your script

  // Close the browser
  await browser.close();
})();
