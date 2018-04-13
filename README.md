1. Clone this git to a "project" folder inside htdocs in xampp.
2. Create folder bin inside "project" folder.
3. Install go. You can see how at https://golang.org/doc/install#windows
4. Add System Environment variables "GOPATH" with value of "project" folder path, for example: "D:/xampp/htdocs/spam-detector"
5. Add System Environment variables "GOBIN" with value of "project/bin", for example: "D:/xampp/htdocs/spam-detector/bin"
6. To compile go codes, type command "go install <package-name>", go will create .exe file to "project/bin"

Notes:
- Make sure package name is main, otherwise compiling the codes will not create .exe, but package file instead.

To know more about Go, see this good and step-by-step documentation https://tour.golang.org/welcome/1 or if you like faster search for certain syntax, see https://www.tutorialspoint.com/go/index.htm