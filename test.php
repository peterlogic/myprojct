basic linux commands

1) clear  ----- (to clear screan)
2)  ls  ------- (list of all dir)
3) cd dir_name -------(path of this dir)
4) cd .. (back command)

Gitt commands
1) git init
2) git add test.php (test.php is a file name)
3) git commit -m "my second project" ( my second project is a comment)
4) git remote add origin https://github.com/pramodtrigma/second-project.git (path of directory where we want to upload file)
5) username  pramodtrigma
6) pass: peter123456
7) git push -u origin master (upload file) 


Git to updating file 
git add .
git push - u origin master




Note: (ex= home/demo)
how to add folder 
1)home/demo# git init
2) git add .



To add a single file on Git
	1) git init
	2) git add test.php (test.php is a file name)
	3) git commit -m "my second project" ( my second project is a comment)
	4) git remote add origin https://github.com/pramodtrigma/second-project.git (path of directory where we want to upload file)
	5) git push -u origin master (upload file)
	6) username  pramodtrigma
	7) pass: peter123456
	
TO add directory on git 
		1) git init 
		2) git add --all (this command is used to add all dir and file from master dir)
		2) git add folder_name* (this command is used to add all data inside master dir) ---- right
		3) git commit -m "my second project" ( my second project is a comment)
		4) git remote add origin https://github.com/pramodtrigma/second-project.git (path of directory where we want to upload file)
		5) git push -u origin master (upload file) 
		6) user: peter123456
		7) pass: 
		
TO edit file on same dir(after editing use these command)
	1) git add test.php
	2) git commit -m "edit file"
	3) git push -u origin master (upload file) 
	5) username  pramodtrigma
	6) pass: peter123456
	
	TO edit and update files in git
		1) first download  repo and save on any new dir
		2) then after made changes on files
		2) git init 
		3) git add --all
		4) git commit -m "update"
		5) git remote add orign master
		6) git pull origin master
		7) git push -u origin master
		8) user name 
		9) pass
		
	