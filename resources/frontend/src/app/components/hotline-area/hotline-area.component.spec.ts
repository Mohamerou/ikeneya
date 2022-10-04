import { ComponentFixture, TestBed } from '@angular/core/testing';

import { HotlineAreaComponent } from './hotline-area.component';

describe('HotlineAreaComponent', () => {
  let component: HotlineAreaComponent;
  let fixture: ComponentFixture<HotlineAreaComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ HotlineAreaComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(HotlineAreaComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
