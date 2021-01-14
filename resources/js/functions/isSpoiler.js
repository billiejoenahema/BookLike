export default function isSpoiler(spoiler) {
    // spoiler: 0 or 1
    if (spoiler === 0) {
        return 'ネタバレなし'
    }
    return 'ネタバレあり'
}
