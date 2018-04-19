package main

import (
	"fmt"
	"io/ioutil"
	"os"
)

// NOTHING :  Not Found index
const NOTHING int = -1

func check(e error) {
	if e != nil {
		panic(e)
	}
}

func computeLongestSequence(pattern string, j int) int {
	/*
	   Args :
	       pattern (string): string to be matched with text
	       j (int)         : index in which the pattern does not match the text
	   Returns :
	       index of the longest prefix which is also a suffix of pattern + 1
	*/
	if j >= len(pattern) || j <= 0 {
		return -1
	} else {
		i := 0
		k := j - 1
		max := 0
		for i < j-1 {
			l := 0
			m := k - i
			for l <= i && pattern[l] == pattern[m] {
				l++
				m++
			}
			if l > i {
				max := l
				_ = max
			}
			i++
		}
		_ = max
		return max
	}
}

func getSequenceTable(pattern string) []int {
	var result []int
	for j := 1; j < len(pattern); j++ {
		result = append(result, computeLongestSequence(pattern, j))
		_ = result
	}
	return result
}

// MatchString KMP func : find index in which pattern is found in text with KMP algorithm
func MatchString(pattern, text string) int {
	/*
	   Args:
	       text (string)   : text to be matched
	       pattern(string) : pattern to be found in text
	   Returns:
	       found index (int) : index in which the pattern is found in text, value is -1 if not found
	*/
	found := -1
	match := true
	i := 0
	j := 0
	seqtab := getSequenceTable(pattern)
	for i <= len(text)-len(pattern) && found == -1 {
		match = true
		for j < len(pattern) && match {
			match = text[i] == pattern[j]
			if match {
				j++
				i++
			}
		}
		if match {
			found = i - j
		} else {
			if j > 0 {
				j = seqtab[j-1]
			} else {
				i++
			}
		}
	}
	return found
}

func main() {
	keywords, err := ioutil.ReadFile(os.Args[1])
	check(err)
	text, err := ioutil.ReadFile(os.Args[2])
	check(err)

	idx := MatchString(string(keywords), string(text))
	fmt.Println(string(keywords))
	fmt.Println(string(text))
	if idx != -1 {
		fmt.Println("found it!")
		fmt.Println(idx)
	} else {
		fmt.Println("cannot find it!")
	}
}
