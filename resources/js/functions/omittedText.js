export const omittedText = (description, limit) => {
  'use strict';
  // 規定文字数を超えたら省略して表示する
  if (limit < description.length) {
    return `${description.substr(0, limit)} ...続きを読む`;
  }
  return description;
};
