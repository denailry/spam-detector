package main

import (
	"fmt"
	"time"
)

func main() {
	fmt.Println("Hello World!")
    current_time := time.Now().Local()
    fmt.Println("The Current time is ", current_time.Format("2006-01-02"))
    goodBye();
}