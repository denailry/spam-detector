package main

import (
	"fmt"
	"regexp"
	"io/ioutil"
	"os"
)

func check(e error) {
	if e != nil {
		panic(e);
	}
}

func main() {
	keywords, err := ioutil.ReadFile(os.Args[1])
	check(err)
	text, err := ioutil.ReadFile(os.Args[2])
	check(err)
	
	matched, e := regexp.MatchString("(?i)"+string(keywords), string(text))
	fmt.Println(string(keywords))
	fmt.Println(string(text))
	if matched {
		fmt.Println("found it!")
		check(e)
		loc := regexp.MustCompile("(?i)"+string(keywords))
		idx := loc.FindStringIndex(string(text))[0]
		fmt.Println(idx)
	} else {
		fmt.Println("cannot find it!")
	}
}
