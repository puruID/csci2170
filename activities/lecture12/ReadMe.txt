<!--- The following README.md sample file was adapted from https://gist.github.com/PurpleBooth/109311bb0361f32d87a2#file-readme-template-md by Gabriella Mosquera for academic use ---> 
<!--- You may delete any comments in this sample README.md file. If needing to use as a .txt file then simply delete all comments, edit as needed, and save as a README.txt file --->

# Lecture Activity 12

**[Optional]** If what is being submitted is an individual Lab or Assignment. Otherwise, include a brief one paragraph description about the project.

* *Date Created*: 14 10 2023
* *Last Modification Date*: 14 10 2023
* *Git URL*: <https://git.cs.dal.ca/parora/csci2170.git>
* *Lab URL*: <https://web.cs.dal.ca/~parora/csci2170/activity/lecture12/>

Sources:

regular expressions:
$nameRegex = "/^[a-zA-Z+\-\ ]+(?: [a-zA-Z]+)?$/";
$lastNameRegex = "/^[a-zA-Z'-]+$/";
$passwordRegex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$_!%*?&])[A-Za-z\d@$_!%*?&]{12,}$/";


Test cases:
first name : Radha mukesh, Puru ,Samkit
last name : Burns-Pope, O'Bries
Password : Puru$arora132 ,  abcdE@1234you