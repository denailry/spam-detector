package main

import (
	"fmt"
	"strings"
)

const CHAR_NUMBER int = 128;

func analyzeLastOccurence(keywords string) [CHAR_NUMBER]int {
	var charIndices [CHAR_NUMBER] int;

	for i := 0; i < CHAR_NUMBER; i++ {
		charIndices[i] = -1;
	}
	for i := 0; i < len(keywords); i++ {
		ascii := keywords[i];
		charIndices[ascii] = i;
	}

	return charIndices;
}

func solve(keywords, text string) bool {
	keywords = strings.ToLower(keywords);
	text = strings.ToLower(text);

	charIndices := analyzeLastOccurence(keywords);

	jMax := len(keywords) - 1;
	iMax := len(text);
	i := jMax;
	j := 0;
	found := false;

	for (i < iMax && !found) {
		for (j <= jMax && keywords[jMax-j] == text[i-j]) {
			j++;
		}
		if (j > jMax) {
			found = true;
		} else {
			differentChar := text[i - j];
			differentIndex := jMax - j;
			if (charIndices[differentChar] > differentIndex) {
				// Shift i once to right
			} else {
				// Align the index of the same chara
			}
		}
	}

	return found;
}

func main() {
	if (solve("keywords", "text")) {
		fmt.Println("found it!");
	} else {
		fmt.Println("cannot found it!");
	}
}