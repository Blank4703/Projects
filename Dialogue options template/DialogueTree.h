#pragma once
#include <iostream>
#include <string>
#include <vector>

using namespace std;

class DialogueOptions;

class DialogueNode{
public:
    string npcDialogue;
    vector <DialogueOptions> options;
};

class DialogueOptions{
public:
    DialogueOptions(string PlayerDialogue, int Reply, DialogueNode *Next);
    string playerDialogue;
    int reply;
    DialogueNode *next;
};

class DialogueTree {
public:
    DialogueTree();

    void init(); //have hard coded this for now. look at the .cpp file for more
    void empty();

    int result();

private:
    vector <DialogueNode *> nodes;
};

