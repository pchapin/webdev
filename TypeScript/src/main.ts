/**
 * Writes a nice greeting to the console.
 *
 * @param name The name to greet
 */
function greet(name: string): void {
  console.log(`Hello, ${name}!`);
}

/**
 * Adds two numbers.
 *
 * @param a The first number
 * @param b The second number
 * @returns The sum of the two numbers
 */
export function add(a: number, b: number): number {
  return a + b;
}

greet('Vite + TypeScript');
document.body.innerHTML = '<h1>Hello, Vite!</h1>';
