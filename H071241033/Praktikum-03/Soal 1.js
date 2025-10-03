function countEvenNumber(x, y) {
    let evenNum = []
    let jumlah = 0
    for (let i = x; i <= y; i++) {
        if (i % 2 === 0) {
            evenNum.push(i)
            jumlah += 1
        }
    }
    return [jumlah, evenNum]
}

console.log(countEvenNumber(1,10))  