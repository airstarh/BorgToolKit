function testUndefined(v) { 
    console.log('1');
    console.log(v);

    if (v === undefined) {
        console.log('2');
        console.log('v is undefined');
    } else { 
        console.log('3');
        console.log(v);
    }
}

testUndefined();
testUndefined(null);

