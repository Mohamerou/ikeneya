import { ComponentFixture, TestBed } from '@angular/core/testing';

import { SpecialistAreaComponent } from './specialist-area.component';

describe('SpecialistAreaComponent', () => {
  let component: SpecialistAreaComponent;
  let fixture: ComponentFixture<SpecialistAreaComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ SpecialistAreaComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(SpecialistAreaComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
