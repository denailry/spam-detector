1. Clone this git to a "project" folder inside htdocs in xampp.
2. Install go. You can see how at https://golang.org/doc/install#windows
3. Add System Environment variables "GOPATH" with value of "project" folder path.
4. Add System Environment variables "GOBIN" with value of "project/bin"
5. To compile go codes, type command "go install <package-name>", go will create .exe file to "project/bin"