export const omittedText = (description, int) => {
  'use strict'
  // 文字数を制限して自己紹介文を表示
  if (description.length > int) {
    return `${description.substr(0, int)} ...続きを読む`
  }
  return description
}
