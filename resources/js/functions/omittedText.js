export default function omittedText(description, int) {

    // ユーザー一覧で文字数を制限して自己紹介文を表示
    // const MAX_LENGTH = 100;

    if (description !== null && description.length > int) {
        return `${description.substr(0, int)}...`;
    }

    return description;
}
