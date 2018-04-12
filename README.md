1. Clone this git to a "project" folder inside htdocs in xampp.
2. Create folder bin inside "project" folder.
3. Install go. You can see how at https://golang.org/doc/install#windows
4. Add System Environment variables "GOPATH" with value of "project" folder path, for example: "D:/xampp/htdocs/spam-detector"
5. Add System Environment variables "GOBIN" with value of "project/bin", for example: "D:/xampp/htdocs/spam-detector/bin"
6. To compile go codes, type command "go install <package-name>", go will create .exe file to "project/bin"