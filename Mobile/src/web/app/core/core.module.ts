import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { CoreRoutingModule } from './core-routing.module';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';
import {DemoNgZorroAntdModule} from '../shared/ng-zorro-antd.module';
import {IconsProviderModule} from '../shared/icons-provider.module';
import {MainComponent} from './components/main/main.component';
import {FooterComponent} from './components/footer/footer.component';
import {SidebarComponent} from './components/sidebar/sidebar.component';


@NgModule({
  declarations: [MainComponent,SidebarComponent,FooterComponent],
  imports: [
    CommonModule,
    CoreRoutingModule,
    DemoNgZorroAntdModule,
    IconsProviderModule,
  ]
})
export class CoreModule { }
