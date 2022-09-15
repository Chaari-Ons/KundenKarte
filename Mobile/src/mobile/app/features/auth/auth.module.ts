import { NgModule } from '@angular/core';
import {CommonModule, DatePipe} from '@angular/common';
import { IonicModule } from '@ionic/angular';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';

import { AuthRoutingModule } from './auth-routing.module';
import {RegisterComponent} from './components/register/register.component';
import {LoginComponent} from './components/login/login.component';
import {LoginGuard} from "../../guard/login.guard";

@NgModule({
  declarations: [RegisterComponent,LoginComponent],
  imports: [
    CommonModule,
    AuthRoutingModule,
    FormsModule,
    IonicModule,
    ReactiveFormsModule,
  ],
  providers: [
    LoginGuard,DatePipe
  ],
})
export class AuthModule { }
