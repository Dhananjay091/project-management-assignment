
1. Login : 
   User Type: Project Manager
   Email: Dhananjay@gmail.com	
   Password: 123456
   
   User type: Employee
   Email: suraj@gmail.com
   Password: 123456
   
   Email: sachin@gmail.com
   Password: 123456
   
   Email: prasad@gmail.com
   Password: 123456
   
   Functionality  done:
   - Manage session using email, password (md5), user type.
   Functionality not done:
   - jquery validation
   

2. Logout :
	Functionality  done: Session destroy.
	
3. User list :	

	Only for Project Manager
	
	Functionality  done:
		- User list with name, email, user type.
		- Users inserted through database
	Functionality not done:
		- Add, edit, delete user.
		- pagination 
4.  Tasks

	For both user types
	
	Functionality  done:
		- Task list with task, project, assigned user, Due date, Priority, Status.
		- Project Manager
			- Add task and assign it to employee
			- 
		- Employee
			- Change status to done / on hold
		
		- Projects inserted through database
		- Ongoing task status to set based on task priority and due date automatic.
		- 
		
	Functionality not done:
		- Add, edit, delete projects.
		- Edit, delete task.
		- Cron job for Ongoing task function is ready which in used at -> Ongoing task status to set based on task priority and due date automatic.
		- Add task jquery validation.    
		- Pagination
		