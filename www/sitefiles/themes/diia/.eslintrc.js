/* 01.05.2020 */
module.exports = {
    env: {
        browser: true, // browser global variables.
        commonjs: true,
        node: true, // Node.js global variables and Node.js-specific rules.
        es6: true
    },
    extends: [
        'airbnb-base' // 06.03.2020
    ],
    "parser": "babel-eslint",
    "parserOptions": {
        ecmaVersion: 6,
        sourceType: 'module',
        ecmaFeatures: {
            impliedStrict: true,
            jsx: true
        }
    },
    // plugins: [prettier'],
    rules: {
        "indent": ["warn", 4], // 06.03.2020
        "no-tabs": ["error", { allowIndentationTabs: true }], // 06.03.2020
        "func-names": ["error", "never"], // 06.03.2020
        "space-before-function-paren": ["error", {
            "anonymous": "never",
            "named": "never",
            "asyncArrow": "never"
        }], // 06.03.2020
        "lines-between-class-members": ["error", "never"], // 06.03.2020
        "no-plusplus": ["error", { "allowForLoopAfterthoughts": true }], // 06.03.2020
        "max-len": ["error", { "code": 10000 }], // 06.03.2020
        "no-new": 0, // 06.03.2020
        // 'linebreak-style': ['error', 'unix'], // 06.03.2020
        "linebreak-style": 0, // 06.03.2020
        "comma-dangle": ["error",
            {
                "arrays": "never",
                "objects": "never",
                "imports": "never",
                "exports": "never",
                "functions": "never"
            }
        ], // 06.03.2020
        "class-methods-use-this": 0, // 06.03.2020
        "import/extensions": 0, // 06.03.2020
        "object-curly-newline": [
            "error",
            {
                "ImportDeclaration": "never",
                "ExportDeclaration": "never"
            }
        ], // 06.03.2020
        "no-console": ["error",
            {
                "allow": [
                    "warn",
                    "log",
                    "error"
                ]
            }
        ], // 06.03.2020
        "import/no-useless-path-segments": "off", // 06.03.2020
        "no-trailing-spaces": ["error", { "ignoreComments": true }], // 06.03.2020
        "max-classes-per-file": ["error", 2], // 06.03.2020
        // "quote-props": ["error", "always"], // 06.03.2020
        // "quotes": ["error", "single", { "avoidEscape": true }], // 06.03.2020
    },
    "globals": {
        "$": true,
        "document": true,
        "Highcharts": true,
        "jQuery": true,
        "L": true,
        "moment": true,
        "nouislider": true,
        "pdfMake": true,
        "Swiper": true,
        "window": true
    }
};
