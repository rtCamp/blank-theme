const { spawn } = require('cross-spawn');

// Get the command-line arguments excluding the first two (node and script.js)
const args = process.argv.slice(2);

// Define the main command you want to run.
const command = './vendor/bin/phpcbf';

// Combine the command and arguments.
const fullCommand = [command, ...args];

// Spawn the process.
const child = spawn(fullCommand[0], fullCommand.slice(1));

// Handle process events.
child.stdout.on('data', (data) => {
  console.log(`stdout: ${data}`);
});

child.stderr.on('data', (data) => {
  console.error(`stderr: ${data}`);
});

child.on('error', (error) => {
  console.error(`Error: ${error.message}`);
});

child.on('close', (code) => {
  console.log(`Child process exited with code ${code}`);
});
