import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { UserRoutingModule } from './user-routing.module';
import {UserComponent} from './user.component';
import {DemoNgZorroAntdModule} from '../../shared/ng-zorro-antd.module';
import {AddUserComponent} from './components/add-user/add-user.component';
import {FormsModule, ReactiveFormsModule} from "@angular/forms";


@NgModule({
  declarations: [UserComponent, AddUserComponent],
  exports: [
    AddUserComponent
  ],
  imports: [
    CommonModule,
    UserRoutingModule,
    DemoNgZorroAntdModule,
    FormsModule,
    ReactiveFormsModule,
  ]
})
export class UserModule { }
