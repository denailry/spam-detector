package main

import (
	"fmt"
	"regexp"
	"io/ioutil"
	"encoding/json"
)

const NOTHING int = -1;

func check(e error) {
	if e != nil {
		panic(e);
	}
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

	matched, e := regexp.MatchString("(?i)"+string(keywords), string(text))
	fmt.Println(string(keywords))
	fmt.Println(string(text))
	if matched && e == nil {
		fmt.Println(0)
	} else {
		fmt.Println(-1)
	}
}
