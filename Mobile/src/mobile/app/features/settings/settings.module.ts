import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { SettingsRoutingModule } from './settings-routing.module';
import {ProfileComponent} from './components/profile/profile.component';
import {SettingsComponent} from './settings.component';
import {IonicModule} from "@ionic/angular";
import {LoginGuard} from "../../guard/login.guard";


@NgModule({
  declarations: [SettingsComponent,ProfileComponent],
    imports: [
        CommonModule,
        SettingsRoutingModule,
        IonicModule
    ],
    providers: [
        LoginGuard
    ],
})
export class SettingsModule { }
