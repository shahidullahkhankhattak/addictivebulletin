module.exports = {
  extends: ["plugin:vue/recommended", "eslint:recommended"],
  rules: {
    indent: ["error", 2]
  },
  env: {
    amd: true
  },
  globals: {
    $: false,
    axios: false,
    Vue: false
  }
};
