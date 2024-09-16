const path = require("path");

module.exports = {
  mode: "production",
  entry: "./js/index.js", // Ensure this path is correct
  output: {
    filename: "scripts.min.js",
    path: path.resolve(__dirname, "assets/js"),
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: "babel-loader",
          options: {
            presets: ["@babel/preset-env"],
          },
        },
      },
    ],
  },
};