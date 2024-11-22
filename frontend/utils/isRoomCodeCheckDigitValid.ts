/**
 * Checks whether a code's check digit is correct
 * @param code the code to check
 * @returns whether code's check digit is correct
 */
export default function (code: string) {
  if (!/^[0-9]{6}$/.test(code)) return false;
  const shouldBe =
    code
      .substring(0, 5)
      .split("")
      .map((v) => Number(v))
      .reduce((prev, curr) => prev + curr, 0) % 10;
  const actual = Number(code[5]);
  return shouldBe === actual;
}
