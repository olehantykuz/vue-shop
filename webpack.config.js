const path = require('path');

module.exports = {
    resolve: {
        extensions: ['.js', '.vue'],
        alias: {
            src: path.resolve(__dirname, 'resources/js'),
        },
    },
};
