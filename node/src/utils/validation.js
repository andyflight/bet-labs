module.exports = {
    isEmail: (email) => /^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(email),
    isNonEmptyString: (str) => typeof str === 'string' && str.trim().length > 0,
    isPositiveNumber: (n) => typeof n === 'number' && n > 0,
  };