import { TestBed } from '@angular/core/testing';

import { MarketBranchService } from './market-branch.service';

describe('MarketBranchService', () => {
  let service: MarketBranchService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(MarketBranchService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
