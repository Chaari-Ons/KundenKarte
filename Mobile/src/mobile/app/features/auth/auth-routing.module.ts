import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import {LoginComponent} from './components/login/login.component';
import {RegisterComponent} from './components/register/register.component';
import {LogoutGuard} from "../../guard/logout.guard";


const routes: Routes = [
  { path: '', pathMatch: 'full', redirectTo: '/login',canActivate: [LogoutGuard]},
  { path: 'login', component: LoginComponent},
  { path: 'register', component: RegisterComponent},
  //{ path: '**', redirectTo: '/login'}
];


@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class AuthRoutingModule { }
