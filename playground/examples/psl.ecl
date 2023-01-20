// We match persons by name
rule PersonWithPerson
    match l : Left!Person
    with r : Right!Person {

    compare: l.name = r.name
}

// We expect only one project 
// in each model and therefore
// we match them unconditionally
rule ProjectWithProject
    match l : Left!Project
    with r : Right!Project {
    
    compare: true
}