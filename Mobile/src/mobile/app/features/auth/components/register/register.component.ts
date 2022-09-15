import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import {FormsModule, NgForm} from "@angular/forms";
import {AuthService} from "../../services/auth.service";
import { DatePipe } from '@angular/common';
@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.scss'],
})
export class RegisterComponent implements OnInit {

  constructor(private router: Router, private authService: AuthService,public datepipe: DatePipe) {}

  date='';
  ngOnInit() {}
  onSave(form: NgForm){
      if (form.invalid) {
          console.log('form invalid');
          return
      }
      //console.log(form.value);
      this.authService.addUser(form.value).subscribe(
          (reponse)=> {
              console.log(reponse);
              console.log('success');
          },
          (error) => {
              console.log(error);
          }
      )



    //this.authService.login(form.value)
    //    .subscribe(
    //        rep=>{
    //          this.router.navigate(['/']);
    //        },err=>{console.log(err);}
    //    );
  }
  changeDate(date) {
      this.date =   this.datepipe.transform(date.value, 'dd.MM.yyyy');
  }
}
