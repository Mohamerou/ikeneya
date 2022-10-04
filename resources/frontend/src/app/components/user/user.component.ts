import { Component, OnInit } from '@angular/core';
import { DataService } from 'src/app/service/data.service';
// import { User } from 'src/app/models/user';

@Component({
  selector: 'app-user',
  templateUrl: './user.component.html',
  styleUrls: ['./user.component.css']
})
export class UserComponent implements OnInit {

  users:any;
  // user = new User();

  constructor() { }

  ngOnInit(): void {
    // this.getAllUsers();
  }

  // getAllUsers() {
  //   this.dataService.getUsers().subscribe(res => {
  //     this.users = res;
  //   });
  // }

  // InsertUserData() {
  //   this.dataService.createUser(this.user).subscribe(res => {
  //     this.getAllUsers();
  //   });
  // }

}
