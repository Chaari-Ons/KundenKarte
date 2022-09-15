import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { AuthRoutingModule } from './auth-routing.module';
import {AuthLayoutComponent} from './components/auth-layout/auth-layout.component';
import {LoginComponent} from './components/login/login.component';
import {RegisterComponent} from './components/register/register.component';
import { IconsProviderModule } from '../../shared/icons-provider.module';
import {DemoNgZorroAntdModule} from '../../shared/ng-zorro-antd.module';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';
import {UserModule} from "../user/user.module";


@NgModule({
  declarations: [
    AuthLayoutComponent,
    LoginComponent,
    RegisterComponent,

  ],
    imports: [
        CommonModule,
        AuthRoutingModule,
        DemoNgZorroAntdModule,
        IconsProviderModule,
        FormsModule,
        ReactiveFormsModule,
        UserModule,
    ]
})
export class AuthModule { }
