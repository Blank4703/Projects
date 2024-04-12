#include <iostream>
#include <string>
#include <list>
#include <cstdlib>
#include "DialogueTree.h"

using namespace std;

int main() {

    DialogueTree dialogueTree;
    dialogueTree.init(); // I have explained more about the instantiation in the DialogueTree.cpp file

    int replyNum = dialogueTree.result();

    if(replyNum == 1){ // again explained more in the .cpp file
        cout << "final dialogue";
    }

    dialogueTree.empty();

    return 0;
}
