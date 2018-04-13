package main

import (
	"fmt"
	"strings"
	"bufio"
	"os"
)

const CHAR_NUMBER int = 128;
const NOTHING int = -1;

func analyzeLastOccurence(keywords string) [CHAR_NUMBER]int {
	var charIndices [CHAR_NUMBER] int;

	for i := 0; i < CHAR_NUMBER; i++ {
		charIndices[i] = NOTHING;
	}
	for i := 0; i < len(keywords); i++ {
		ascii := keywords[i];
		charIndices[ascii] = i;
	}

	return charIndices;
}

func solve(keywords, text string) int {
	keywords = strings.ToLower(keywords);
	text = strings.ToLower(text);

	charIndices := analyzeLastOccurence(keywords);

	jMax := len(keywords) - 1;
	iMax := len(text);
	i := jMax;
	j := 0;
	found := -1;

	for (i < iMax && found == -1) {
		for (j <= jMax && keywords[jMax - j] == text[i - j]) {
			j++;
		}
		if (j > jMax) {
			found = i - (j - 1);
		} else {
			indexInKeywords := jMax - j;
			indexInText := i - j;
			charInText := text[indexInText];
			if (charIndices[charInText] == NOTHING) {
				i += indexInKeywords + 1;
			} else if (charIndices[charInText] > indexInKeywords) {
				i++;
			} else {
				i += indexInKeywords - charIndices[charInText];
			}
		}
	}

	return found;
}

func main() {
	reader := bufio.NewReader(os.Stdin);
	fmt.Print("Text: ");
	text, _ := reader.ReadString('\n');
	fmt.Print("Keywords: ");
	keywords, _ := reader.ReadString('\n');

	text = text[0:len(text)-1];
	keywords = keywords[0:len(keywords)-1];

	idx := solve(keywords, text);
	if (idx != -1) {
		fmt.Println("found it!");
		fmt.Println(idx);
	} else {
		fmt.Println("cannot find it!");
	}
}