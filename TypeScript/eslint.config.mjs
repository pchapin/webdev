import globals from "globals";
import pluginJs from "@eslint/js";
import tseslint from "typescript-eslint";


/** @type {import('eslint').Linter.FlatConfig[]} */
export default [
  {
    files: ["**/*.{js,mjs,cjs,ts}"],
    languageOptions: {
      ecmaVersion: 'latest',
      sourceType: 'module',
      globals: globals.browser,
    }
  },
  {
    files: ["**/*.js"],
    languageOptions: {
      sourceType: "commonjs"
    }
  },
  pluginJs.configs.recommended,
  ...tseslint.configs.recommended,
  {
    plugins: {
      '@typescript-eslint': tseslint.plugin,
    },
    rules: {
      // Require return types for all exported functions
      '@typescript-eslint/explicit-function-return-type': ['error', {
        allowExpressions: false,
        allowTypedFunctionExpressions: false
      }],

      // Disallow 'any' and non-null assertions
      '@typescript-eslint/no-explicit-any': 'error',
      '@typescript-eslint/no-non-null-assertion': 'error',

      // Enforce 'unknown' in catch blocks
      '@typescript-eslint/no-implicit-any-catch': 'error',

      // Enforce boolean clarity
      '@typescript-eslint/strict-boolean-expressions': 'error',

      // Prefer modern optional patterns
      '@typescript-eslint/prefer-optional-chain': 'warn',
      '@typescript-eslint/prefer-nullish-coalescing': 'warn',

      // Prevent silent promise errors
      '@typescript-eslint/no-floating-promises': 'error',
      '@typescript-eslint/no-misused-promises': 'error',

      // Encourage cleanup
      '@typescript-eslint/no-unused-vars': ['error', { argsIgnorePattern: '^_' }]
    }
  }
];