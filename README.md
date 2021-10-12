# Git intructions

## Cloning the repository
- Open up the GitBash terminal (or any other - VSCode works too);
- Go to the XAMPP directory where websites are stored with the <span style = "color:yellow">**cd**</span> command. Usually it's located at *C:\xampp\htdocs*;
- Once you're in the directory, type in <span style = "color:yellow">**git clone https://github.com/MantasAbr/teachnology.git**</span>

## Branches

### Creating branches
- Before starting a new branch for your work, make sure that you're currently in the *master* branch. Type in the command <span style = "color:yellow">**git branch**</span>. The current branch will be highlighted;
- Once you've confirmed you're in the *master* branch, type in the command <span style = "color:yellow">**git checkout -b *your branch name***</span>. This will create a new branch with the name that you've specified.

### Changing branches
- To change the branch that you're currently in, type in the command <span style = "color:yellow">**git branch -a**</span> to see all the branches that are both in the remote and local repositories;
- Type in the command <span style = "color:yellow">**git checkout *branch name***</span> to switch to the branch that you wish.

### Deleting branches
- Once you’ve finished working on a branch and have merged it into the main code base, you’re free to delete the branch without losing any history with this command <span style = "color:yellow">**git branch -d *branch name***</span>;

## Pushing your work to the repository

### Pushing to our local repository
- First, select the files that you wish to add to the commit. If you want to commit all the files that you've worked on, type in the command <span style = "color:yellow">**git add .**</span> (The dot is neccessary);
- Then, type in <span style = "color:yellow">**git commit -m "*meaningful message here*"**</span> (Quotation marks are neccessary). This will commit the changes to your **local repository**;
- Repeat these two steps for all the changes that you make. Once you've feel that the work you've did can be **safely** pushed to the remote repository, continue on to the next step.

### Pushing to the remote repository
- Simply type in <span style = "color:yellow">**git push origin *branch name***</span> to push the changes of your branch to the remote repository.

## Running the site on your local machine
- Make sure you're in the repo folder first. If not, use the commands that are written in the **Cloning the repository** step;
- Type in the command <span style = "color:yellow">**php artisan serve**</span> to start the website on your local machine. The URL to reach it by default should be **http://127.0.0.1:8000**.