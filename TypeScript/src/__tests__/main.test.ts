import { describe, it, expect } from 'vitest';
import { add } from '../main';

describe('math operations', (): void => {
  it('should add two numbers correctly', (): void => {
    const result = add(2, 2);
    expect(result).toBe(4);
  });

  it('should multiply two numbers correctly', (): void => {
    const result = add(-2, 2);
    expect(result).toBe(0);
  });
});
