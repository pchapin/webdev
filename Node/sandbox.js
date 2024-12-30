
function hello() {
  // JavaScript has `let` and `const` keywords to declare variables. The older `var` keyword is
  // still available, but it has some issues that `let` and `const` don't have. For example,
  // `var` has function scope, while `let` and `const` have block scope. Thus use of `var` is
  // discouraged.
  //
  let message = 'I can display Unicode characters: cos(αβ)';
  console.log(message);
}

hello();

// JavaScript uses IEEE 754 floating point values to represent its Number type. This means that
// it can represent numbers with a precision of 53 bits. This is equivalent to 15 to 16 decimal
// digits, and is why you can't represent numbers, including integers, with more than 15 to 16
// decimal digits in JavaScript.
//
console.log(Number.MAX_SAFE_INTEGER);
console.log(Number.MIN_SAFE_INTEGER);
console.log(Number.MAX_VALUE);
console.log(Number.MIN_VALUE);

// However, JavaScript has a BigInt type that can represent integers with arbitrary precision.
console.log(123456789123456789123456789n * 10000000n);