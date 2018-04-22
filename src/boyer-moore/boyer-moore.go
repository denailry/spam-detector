package main

import (
	"fmt"
	"strings"
	"io/ioutil"
	"encoding/json"
)

const CHAR_NUMBER int = 128;
const NOTHING int = -1;

func check(e error) {
	if e != nil {
		panic(e);
	}
}

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

func readJSON(filename string) (string, string) {
	type Input struct {
		Keywords string
		Text string
	}
	var input Input;

	inputJSON, ioErr := ioutil.ReadFile("res/input.json");
	check(ioErr);
	jsonErr := json.Unmarshal(inputJSON, &input);
	if jsonErr == nil {
		return input.Keywords, input.Text;
	} else {
		return "", "";
	}
}

func main() {
	keywords, text := readJSON("res/input.json");
	idx := solve(keywords, text);
	fmt.Println(idx);
}