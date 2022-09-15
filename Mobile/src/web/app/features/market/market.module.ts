import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { MarketRoutingModule } from './market-routing.module';
import {MarketComponent} from './market.component';
import {DemoNgZorroAntdModule} from '../../shared/ng-zorro-antd.module';
import { NzUploadModule } from 'ng-zorro-antd/upload';
import {AddMarketComponent} from './components/add-market/add-market.component';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';
import {EditMarketComponent} from './components/edit-market/edit-market.component';
import {ListMarketBranchesComponent} from './components/list-market-branches/list-market-branches.component';
import {AddMarketBranchComponent} from './components/add-market-branch/add-market-branch.component';
import {EditMarketBranchComponent} from './components/edit-market-branch/edit-market-branch.component';

@NgModule({
  declarations: [MarketComponent,
                 AddMarketComponent,
                 EditMarketComponent,
                 ListMarketBranchesComponent,
                 AddMarketBranchComponent,
                 EditMarketBranchComponent
  ],
  imports: [
    CommonModule,
    MarketRoutingModule,
    DemoNgZorroAntdModule,
    NzUploadModule,
    FormsModule,
    ReactiveFormsModule,
  ]
})
export class MarketModule { }
