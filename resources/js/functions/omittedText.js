export default function omittedText(description, int) {

    // 文字数を制限して自己紹介文を表示
    if (description.length > int) {
        return `${description.substr(0, int)}...`;
    }

    return description;
}
